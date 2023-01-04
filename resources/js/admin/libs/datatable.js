import dt from 'datatables.net/js/jquery.dataTables.min'

import dtResponsive from 'datatables.net-responsive-dt'

// $('div.dataTables_filter input').addClass('input border border-theme-7');
(function($) {
    "use strict";

    // Datatable
    $('.datatable').DataTable({
        processing: true,
        responsive: true,
    })
})($)