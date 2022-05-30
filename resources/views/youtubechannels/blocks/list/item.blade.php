<?php /** @var \App\Models\Youtubechannel $youtubechannel */ ?>

<article class="mb-3">

    <h2>Channel: <strong>{{ $youtubechannel->name }}</strong></h2><h3> Raiting: {{ $youtubechannel->raiting }}</h3>
    <h4>Total like: {{ $youtubechannel->totalLike }} Total dislakes: {{ $youtubechannel->totaldislikes }}</h4>

    <table class="table table-sm">
        @foreach ($youtubechannel->videos as $videos)
            <tr>
                <td><h5>Video: {{$videos['title']}}</h5></td>
                <td><p>like: {{$videos['like']}}</p></td>
                <td><p>dislikes: {{$videos['dislikes']}}</p></td>
                <td><p>url: {{$videos['videourl']}}</p></td>

            </tr>
        @endforeach
    </table>
</article>

