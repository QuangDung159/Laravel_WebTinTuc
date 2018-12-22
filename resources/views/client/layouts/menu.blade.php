<div class="col-md-3 ">
    <ul class="list-group" id="menu">
        <li href="#" class="list-group-item menu1 active">
            Menu
        </li>

        @foreach($list_the_loai as $the_loai)
            @if(count($the_loai->loaitin))
                <li href="#" class="list-group-item menu1">
                    {{$the_loai->Ten}}
                </li>
                <ul>
                    @foreach($the_loai->loaitin as $loai_tin)
                        <li class="list-group-item">
                            <a href="loaitin/{{$loai_tin->id}}/{{$loai_tin->TenKhongDau}}.html">{{$loai_tin->Ten}}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endforeach
    </ul>
</div>