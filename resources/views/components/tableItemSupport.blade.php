<tr>
    <th scope="row">{{$number}}</th>
    <td>
        {{$module}}
    </td>
    <td>@include('components.checkOrCloseIcon', [
                    'isSupported' => $isSupported])
    </td>
    <td>{{$description}}</td>
</tr>