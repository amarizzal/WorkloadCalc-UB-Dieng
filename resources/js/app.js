require('./bootstrap');

import 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.html5.js';
import 'datatables.net-buttons/js/buttons.print.js';
import jsZip from 'jszip';
import pdfMake from 'pdfmake/build/pdfmake';
import * as pdfFonts from 'pdfmake/build/vfs_fonts';
import $ from 'jquery';
pdfMake.vfs = pdfFonts.vfs;
window.JSZip = jsZip;
window.$ = $;
window.jQuery = $;
import '../scss/custom-datatables.scss';
import '../scss/custom-mobile.scss';