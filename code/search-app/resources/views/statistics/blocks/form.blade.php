<form class="" id="statisticsForm">
    <div class="row">
        <div class="col col-md-5">
            <input type="text" class="form-control" name="query" value="{{ request('query') }}" placeholder="Поиск ...">
        </div>
        <div class="col col-md-5">
            <select class="form-control" name="type">
                <option value="sum" @if (request('type') == 'sum') selected @endif >Суммарное кол-во лайков/дизлайков</option>
                <option value="top" @if (request('type') == 'top') selected @endif>Топ каналов с лучшим соотношением лайков/дизлайков</option>
            </select>
        </div>
        <div class="col col-md-2">
            <button type="submit" class="btn btn-primary btn-block">Поиск</button>
        </div>
    </div>
</form>
