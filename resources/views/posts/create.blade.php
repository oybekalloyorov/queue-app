<h1>Post yaratish</h1>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Sarlavha"> <br>
    <textarea name="content" placeholder="Kontent"></textarea> <br>
    <button type="submit">Saqlash</button>
</form>
