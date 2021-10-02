
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{ $titles->getTitleName() }}</th>
                <th scope="col">{{ $titles->getValueName() }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($rows as $row)
            <tr>
                <td>{{ $row->title }}</td>
                <td><strong>{{ $row->value }}</strong></td>
            </tr>
            @empty

            @endforelse
            </tbody>
        </table>
    </div>

