@forelse ($youtubechannels as $youtubechannel)
    @include('youtubechannels.blocks.list.item')
@empty
    <p>No articles found</p>
@endforelse
