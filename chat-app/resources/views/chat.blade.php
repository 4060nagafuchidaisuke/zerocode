<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ながだいとゆかいな仲間のつぶやき</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50">
  <div class="max-w-md mx-auto h-dvh flex flex-col bg-gray-200 shadow-lg">

    <header class="bg-white px-4 py-3 flex items-center justify-between shadow-sm">
      <a href="/rooms" class="text-sm text-gray-500">← 一覧</a>
      <h1 class="font-bold">{{ $room->name }}</h1>
      <a href="/enter" class="text-sm text-gray-500">{{ session('nickname') }}</a>
    </header>

    <main id="messages" class="flex-1 overflow-y-auto p-4">
      @foreach ($messages as $message)
        @if ($message->name === session('nickname'))
          <div class="mb-3 text-right">
            <p class="text-xs text-gray-500 mb-1">{{ $message->name }} {{ $message->created_at->format('H:i') }}</p>
            <div class="bg-orange-400 text-black rounded-2xl px-4 py-2 inline-block max-w-[75%] text-left break-words">
              <p>{{ $message->body }}</p>
            </div>
            <div class="mt-1">
              <a href="/messages/{{ $message->id }}/edit" class="text-xs text-gray-500">編集</a>
              <form action="/messages/{{ $message->id }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-xs text-red-400">削除</button>
              </form>
            </div>
          </div>
        @else
          <div class="mb-3 flex items-start gap-2">
            <div class="shrink-0 w-8 h-8 rounded-full bg-gray-400 text-white text-sm flex items-center justify-center">{{ mb_substr($message->name, 0, 1) }}</div>
            <div class="min-w-0 max-w-[75%]">
              <p class="text-xs text-gray-500 mb-1">{{ $message->name }} {{ $message->created_at->format('H:i') }}</p>
              <div class="bg-white rounded-2xl px-4 py-2 inline-block shadow-sm break-words">
                <p>{{ $message->body }}</p>
              </div>
              <div class="mt-1">
                @foreach (['😀', '😂', '👍', '❤️', '🎉', '😢'] as $emoji)
                  @php
                    $count = $message->reactions->where('emoji', $emoji)->count();
                    $mine = $message->reactions->where('emoji', $emoji)->where('name', session('nickname'))->isNotEmpty();
                  @endphp
                  <form action="/messages/{{ $message->id }}/reactions" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="emoji" value="{{ $emoji }}">
                    <button type="submit" class="{{ $mine ? 'bg-orange-400' : 'bg-white' }} border border-gray-300 rounded-full px-2 h-8 text-sm">{{ $emoji }}@if ($count > 0) {{ $count }}@endif</button>
                  </form>
                @endforeach
              </div>
            </div>
          </div>
        @endif
      @endforeach
    </main>
    <footer class="bg-white p-3">
      <form action="/rooms/{{ $room->id }}" method="POST" class="flex flex-wrap gap-2">
        @csrf
        <input type="text" name="body" placeholder="メッセージを入力" value="{{ old('body') }}"
          class="flex-1 bg-gray-100 rounded-full px-4 py-2">
        <button type="submit" class="shrink-0 bg-yellow-400 text-black font-bold rounded-full px-5 py-2">送信</button>
        <div class="flex gap-2 w-full">
          @foreach (['😀', '😂', '👍', '❤️', '🎉', '😢'] as $emoji)
            <button type="button" data-emoji="{{ $emoji }}"
              class="emoji-button bg-orange-400 rounded-full w-10 h-10">{{ $emoji }}</button>
          @endforeach
        </div>
      </form>
      @error('body')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
      @enderror
    </footer>

  </div>
  <script>
    // ページを開いたとき、メッセージ一覧を一番下までスクロールする
    const messages = document.getElementById('messages');
    messages.scrollTop = messages.scrollHeight;

    // 絵文字ボタンを押したら、入力欄の最後に絵文字を足す
    const input = document.querySelector('input[name="body"]');
    document.querySelectorAll('.emoji-button').forEach((button) => {
      button.addEventListener('click', () => {
        input.value += button.dataset.emoji;
        input.focus();
      });
    });

    // 5秒ごとに、メッセージ一覧の部分だけを入れ替える
    setInterval(async () => {
      const res = await fetch(location.href);
      const html = await res.text();
      const doc = new DOMParser().parseFromString(html, 'text/html');
      document.getElementById('messages').innerHTML =
        doc.getElementById('messages').innerHTML;
    }, 5000);
  </script>
</body>
</html>