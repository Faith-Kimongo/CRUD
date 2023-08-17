<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @auth
    <p>Logged In</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Log Out</button>
    </form>

    <div style="padding: 3px; border: 3px solid  black;">
        <form action="/create-post" method="POST">
            @csrf
            <input name="title" placeholder="title" type="text"/>
            <textarea name="body" placeholder="blog body....."></textarea>
            <button>Create a Post</button>
        </form>
    </div>

    <div style="padding:3px; margin:12px; border: 3px solid  black; background-color: gray;">
        <h2>All Posts</h2>
        @foreach ($posts as $post)
        <div style="padding:3px; border: 3px solid  black; background-color: rgb(191, 191, 214);">
            <h3>{{ $post['title'] }} by {{ $post->user->name }}</h3>
            {{ $post['body'] }}

            <p><a href="/edit-post/{{ $post->id }}">Edit</a></p>
            <form action="/delete-post/{{ $post->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
        @endforeach
    </div>
    @else
        <div style="padding: 3px; border: 3px solid  black;">
            <h1>Register</h1>
            <form action="/register" method="POST">
                @csrf
                <input name="name" type="text" placeholder="name"/>
                <input name="email" type="email" placeholder="email"/>
                <input name="password" type="password" placeholder="password"/>
                <button>Register</button>
            </form>
        </div>

        <div style="padding:3px; border: 3px solid  black;">
            <h1>Login</h1>
            <form action="/login" method="POST">
                @csrf
                <input name="loginname" type="text" placeholder="name"/>
                <input name="loginpassword" type="password" placeholder="password"/>
                <button>Login</button>
            </form>
        </div>
    @endauth

</body>
</html>