/* import './bootstrap'; */
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import 'flowbite';
import { Carousel, Input, Datepicker, Select, Timepicker, initTE } from "tw-elements";
initTE({ Carousel, Input, Select }); // set second parameter to true if you want to use a debugger

const datepickerDisablePast = document.getElementById('dateID');
new Datepicker(datepickerDisablePast, {
  disablePast: true
});

const picker1 = document.getElementById("timeStart");
const picker2 = document.getElementById("timeEnd");
const tpStart = new Timepicker(picker1, {
  format24: true
});
const tpEnd = new Timepicker(picker2, {
  format24: true,
});