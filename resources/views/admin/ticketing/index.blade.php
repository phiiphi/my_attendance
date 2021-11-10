@extends('layouts.admin')
@section('content')
{{-- <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="#">
            {{ trans('global.add') }} {{ trans('cruds.ticket.title_singular') }}
        </a>
    </div>
</div> --}}
<div class="card">
    {{-- <div class="card-header">
        {{ trans('cruds.ticket.title_singular') }} {{ trans('global.list') }}
    </div> --}}

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                    <tr>
                        <th width="15">

                        </th>
                        <th>
                            TICKETS NUMBER
                        </th>
                        <th>
                            TICKET DESCRIPTION
                        </th>
                        <th>
                            PRICE
                        </th>
                        <th>
                            CAR NUMBER
                        </th>
                        <th>
                            Action
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $key => $ticket)
                        <tr data-entry-id="{{ $ticket->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $ticket->ticket_number ?? '' }}
                            </td>
                            <td>
                                {{ $ticket->price ?? '' }}
                            </td>
                            <td> 
                            {{ $ticket->ticket_description ?? '' }}

                            </td>
                            <td>
                            {{ $ticket->car_number ?? '' }}

                            </td>

                            <td>
                                <!-- <a class="btn btn-xs btn-primary" href="{{ route('admin.ticketing.show', $ticket->id) }}">
                                    {{ trans('global.view') }}
                                </a> -->

                                <a class="btn btn-xs btn-info" href="{{ route('admin.ticketing.edit', $ticket->id) }}">
                                    {{ trans('global.edit') }}
                                </a>

                                <form action="{{ route('admin.companies.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.student.mass_destroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Permission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection