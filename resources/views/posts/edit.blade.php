<h1>Edit Post</h1>
<form method="POST" action="{{ route('posts.update', $post->id) }}">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $post->title }}"><br>
    <textarea name="content">{{ $post->content }}</textarea><br>
    <button type="submit">Update</button>
</form>
