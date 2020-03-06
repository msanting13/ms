<table>
  @foreach($data as $customer)
    <tr>
      <td>{{ $customer->title }}</td>
    </tr>
    @endforeach
</table>