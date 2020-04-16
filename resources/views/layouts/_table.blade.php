<table class="table table-primary table-light table-hovered">
  <thead class="bg-primary text-light">
    <tr>
      <th>id</th>
      <th>title</th>
      <th>body</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row">{{$tableDataId}}</td>
      <td>{{$tableDataTitle}}</td>
      <td>{{$tableDataBody}}</td>
      <td class="d-flex">
        <a href="#" class="btn btn-sm btn-success m-1"><i data-feather="eye" style="width:24px;"></i></a>
        <a href="#" class="btn btn-sm btn-warning m-1"><i data-feather="edit" style="width:24px;"></i></a>
        <a href="#" class="btn btn-sm btn-danger m-1"><i data-feather="trash" style="width:24px;"></i></a>
      </td>
    </tr>
  </tbody>
</table>