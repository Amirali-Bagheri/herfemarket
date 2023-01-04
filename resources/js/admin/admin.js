window._ = require('lodash');

// import $ from 'jquery'
// import '../../icons/icons'
// import Swal from 'sweetalert2/dist/sweetalert2.all.min'

require('./libs/app');

// Components
// import showCode from './libs/show-code'

// window.$ = window.jQuery = $
// window.helper = helper
//
//
// require('./libs/chart');
// require('./libs/highlight');
// require('./libs/feather');
// require('./libs/slick');
// require('./libs/tooltipster');
// // require('./libs/datatable');
// require('./libs/datepicker');
// require('./libs/select2');
// require('./libs/dropzone');
// // require('./libs/summernote');
// require('./libs/validation');
// require('./libs/image-zoom');
// require('./libs/svg-loader');
// require('./libs/toast');

window.addEventListener('swal', function (e) {
    Swal.fire(e.detail);
})
window.onscroll = function (ev) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        window.livewire.emit('load-more');
    }
};

window.addEventListener('close-modal', event => {
    $(event.detail.id).modal('hide');
})

window.addEventListener('livewire:load', function (event) {
    window.livewire.hook('afterDomUpdate', () => {
        $('.select2').select2();
    });
});


window.onscroll = function(ev) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        window.livewire.emit('load-more');
    }
};
// require('./libs/file-manager')

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token)
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
else
    console.error('CSRF token not found');
