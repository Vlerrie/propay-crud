<h3 style="color: black">Hi {{$person->name}},</h3>
<h4 style="color: black">Your info has been captured by {{$person->creator->name}}, please see data below:</h4>

<table>
    <tr>
        <th>Names</th>
        <td>{{$person->name}}</td>
    </tr>
    <tr>
        <th>Mobile Number</th>
        <td>{{$person->mobile}}</td>
    </tr>
    <tr>
        <th>Language</th>
        <td>{{$person->language->name}}</td>
    </tr>
    <tr>
        <th>SA ID Number</th>
        <td>*********{{substr($person->sa_id, -4, 4)}}</td>
    </tr>
</table>
