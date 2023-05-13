<div>
    <style>
        .post-stats {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .post-stats li {
            display: inline-block;
            margin-right: 10px;
            font-size: 14px;
            color: #4287f5;
        }

        .like-button,
        .dislike-button {
            padding: 4px 10px;
            border-color:#4287f5;
            color:dimgray;
            border-width: 1px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            transition: color 0.3s;
        }

        .like-button.clicked {
            color:blueviolet;
            background-color:aqua;
        }
        .dislike-button.clicked {
            color:blueviolet;
            background-color:aqua;
        }
    </style>
    <ul class="post-stats">
        <li>Likes: {{ $post->likes_count ?? 'Unknown' }}</li>
        <li>Dislikes: {{ $post->dislikes_count ?? 'Unknown' }}</li>
        <li>Views: {{ $post->views_count ?? 'Unknown' }}</li>
    </ul>
    @auth
    <div>
        <button class="like-button {{ $likeButtonActive ? 'clicked' : '' }}" wire:click="like" alt="Like">
            Like <i class="fa fa-thumbs-up" style="font-size:24px;"></i>
        </button>
        <button class="dislike-button {{ $dislikeButtonActive ? 'clicked' : '' }}" wire:click="dislike" alt="Dislike">
            Dislike <i class="fa fa-thumbs-down" style="font-size:24px;"></i>
        </button>
    </div>
    @endauth
</div>
