    <div style="margin: 0px 50px 0px 50px;">
        @if($pages)
        <table class="table table-hover table-striped">
        <thead>
            <tr>
            <th>N</th>
            <th>Name</th>
            <th>Alias</th>
            <th>Text</th>
            <th>Created Date</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
            @foreach($pages as $key => $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{!! Html::link(route('PagesEdit',['page'=>$page->id]),$page->name,['alt'=>$page->name]) !!}</td>
                    <td>{{ $page->alias }}</td>
                    <td>{{ $page->text }}</td>
                    <td>{{ $page->created_at }}</td>
                    <td>
                    {!! Form::open(['url'>route('PagesEdit',['page'=>$page->id]), 'class'=>'form-horizontal','method'=>'POST']) !!}
                        {!! Form::hidden('action','delete') !!}
                        {!! Form::button('Delete',['class'=>'btn btn-danger','type'=>'submit']) !!}
                    {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
        @endif
            {!! Html::link(route('PagesAdd',['page'=>$page->id]),'New Page') !!}
    </div>