@extends('layouts.app')
@section('content')
@section('title', 'CRUD 1 - Index')

<div class="page-content">
  <div class="page-header">
    <h1>CRUD 1 <small><i class="ace-icon fa fa-angle-double-right"></i> Index</small></h1>
  </div>

  <div class="row">
    <div class="col-xs-12">

      <div class="widget-header widget-header-flat" style="background-color: #618f8f;">
        <h4 class="widget-title " style="color: #fff;">CRUD List</h4>
        <span class="widget-toolbar">
          <a href="{{ route('dashboard.crud-1.create') }}" style="color: #fff;">
            <i class="ace-icon fa fa-plus"></i> Create New
          </a>
        </span>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="crud1-table">
          <thead>
            <tr>
              <th>Sl</th>
              <th>Topic</th>
              <th>Title</th>
              <th>Description</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="crud1-body"></tbody>
        </table>
        <nav id="pagination-links" class="text-center mt-3"></nav>
      </div>

    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {

    const tbody = document.getElementById('crud1-body');
    const pagination = document.getElementById('pagination-links');

    // Fetch data function
    function fetchData(page = 1) {
      axios.get(`/api/dashboard/crud-1?page=${page}`)
        .then(res => {
          tbody.innerHTML = '';
          const data = res.data.data;
          if (data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">No data found.</td></tr>';
            pagination.innerHTML = '';
            return;
          }

          let sl = (res.data.current_page - 1) * res.data.per_page + 1;

          data.forEach(item => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                        <td>${sl++}</td>
                        <td>${item.topic_name}</td>
                        <td>${item.title}</td>
                        <td>${item.description}</td>
                        <td>${item.status === 'active' ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>'}</td>
                        <td>
                            <a href="/dashboard/crud-1/${item.id}/edit" class="green"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
                            <button class="red delete-btn" data-id="${item.id}"><i class="ace-icon fa fa-trash-o bigger-130"></i></button>
                        </td>
                    `;
            tbody.appendChild(tr);
          });

          // Pagination
          let links = '';
          for (let i = 1; i <= res.data.last_page; i++) {
            links += `<button class="page-btn btn btn-sm btn-primary m-1 ${i === res.data.current_page ? 'active' : ''}" data-page="${i}">${i}</button>`;
          }
          pagination.innerHTML = links;

          // Pagination click
          document.querySelectorAll('.page-btn').forEach(btn => {
            btn.addEventListener('click', function() {
              const page = btn.getAttribute('data-page');
              fetchData(page);
            });
          });

          // Delete button
          document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
              if (confirm('Are you sure to delete this item?')) {
                const id = btn.getAttribute('data-id');
                axios.delete(`/api/dashboard/crud-1/${id}`)
                  .then(res => {
                    alert(res.data.message);
                    fetchData(res.data.current_page || 1);
                  })
                  .catch(err => {
                    console.error(err);
                    alert('Delete failed!');
                  });
              }
            });
          });

        })
        .catch(err => {
          console.error(err);
          tbody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Error fetching data!</td></tr>';
        });
    }

    fetchData(); // initial load
  });

</script>

@endsection

