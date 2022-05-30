@forelse ($youtubechannels as $youtubechannel)
    @include('youtubechannels.blocks.list.item')
@empty
    <p>No channel found</p>
@endforelse
