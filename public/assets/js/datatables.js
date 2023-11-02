// Date
let tanggal = new Date().getDate()
let bulan = new Date().getMonth()
let tahun = new Date().getFullYear()

// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    select: true,
    dom: 'Bfrtip',
    lengthMenu: [
      [ 10, 25, 50, -1 ],
      [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ],
    columnDefs: [
      { "searchable": false, "targets": 7 }
    ],
        buttons: [
          {
            extend: 'print',
            text: 'Print',
            title: document.title + ` | ${tanggal}-${bulan}-${tahun} `,
            className: 'btn btn-sm btn-primary',
            exportOptions: {
              columns: 'th:not(:last-child)'
            },
          },
          {
            extend: 'excel',
            text: 'Excel',
            title: document.title + ` | ${tanggal}-${bulan}-${tahun} `,
            className: 'btn btn-sm btn-success',
            exportOptions: {
              columns: 'th:not(:last-child)'
            },
          },
          {
            extend: 'pdf',
            text: 'PDF',
            title: document.title + ` | ${tanggal}-${bulan}-${tahun} `,
            className: 'btn btn-sm btn-danger',
            exportOptions: {
              columns: 'th:not(:last-child)'
            },
            customize: function (doc) {
              doc.content[1].table.widths = 
                  Array(doc.content[1].table.body[0].length + 1).join('*').split('');
            }
          },
          {
            extend: 'pageLength',
            className: 'btn btn-sm btn-secondary',
          }
        ],
    scrollX: true,
  });

});

$(document).ready(function() {
  $('#dataTable2').DataTable({
    select: true,
    dom: 'Bfrtip',
    lengthMenu: [
      [ 10, 25, 50, -1 ],
      [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ],
        buttons: [
          {
            extend: 'print',
            text: 'Print',
            title: document.title + ` | ${tanggal}-${bulan}-${tahun} `,
            className: 'btn btn-sm btn-primary',
            exportOptions: {
              columns: 'th:not(:last-child)'
            },
          },
          {
            extend: 'excel',
            text: 'Excel',
            title: document.title + ` | ${tanggal}-${bulan}-${tahun} `,
            className: 'btn btn-sm btn-success',
            exportOptions: {
              columns: 'th:not(:last-child)'
            },
          },
          {
            extend: 'pdf',
            text: 'PDF',
            title: document.title + ` | ${tanggal}-${bulan}-${tahun} `,
            className: 'btn btn-sm btn-danger',
            exportOptions: {
              columns: 'th:not(:last-child)'
            },
          },
          {
            extend: 'pageLength',
            className: 'btn btn-sm btn-secondary',
          }
        ],
    scrollX: true,
  });
});

$(document).ready(function() {
  $('#dataTableMin').DataTable({
    select: true,
    dom: 'Bfrtip',
    lengthMenu: [
      [ 10, 25, 50, -1 ],
      [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ],
    columnDefs: [
      { "searchable": false, "targets": 4 }
    ],
        buttons: [
          {
            extend: 'print',
            text: 'Print',
            title: document.title + ` | ${tanggal}-${bulan}-${tahun} `,
            className: 'btn btn-sm btn-primary',
            exportOptions: {
              columns: 'th:not(:last-child)'
            },
          },
          {
            extend: 'excel',
            text: 'Excel',
            title: document.title + ` | ${tanggal}-${bulan}-${tahun} `,
            className: 'btn btn-sm btn-success',
            exportOptions: {
              columns: 'th:not(:last-child)'
            },
          },
          {
            extend: 'pdf',
            text: 'PDF',
            title: document.title + ` | ${tanggal}-${bulan}-${tahun} `,
            className: 'btn btn-sm btn-danger',
            exportOptions: {
              columns: 'th:not(:last-child)'
            },
          },
          {
            extend: 'pageLength',
            className: 'btn btn-sm btn-secondary',
          }
        ],
    scrollX: true,
  });
  table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' )
});

$(document).ready(function() {
  $('#dataTableExport').DataTable({
    select: true,
    dom: 'Bfrtip',
    lengthMenu: [
      [ 10, 25, 50, -1 ],
      [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ],
        buttons: [
          {
            extend: 'print',
            text: 'Print',
            title: document.title + ` | ${tanggal}-${bulan}-${tahun} `,
            className: 'btn btn-sm btn-primary',
          },
          {
            extend: 'excel',
            text: 'Excel',
            title: document.title + ` | ${tanggal}-${bulan}-${tahun} `,
            className: 'btn btn-sm btn-success',
          },
          {
            extend: 'pdf',
            text: 'PDF',
            title: document.title + ` | ${tanggal}-${bulan}-${tahun} `,
            className: 'btn btn-sm btn-danger',
          },
          {
            extend: 'pageLength',
            className: 'btn btn-sm btn-secondary',
          }
        ],
    scrollX: true,
  });
  table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' )
});