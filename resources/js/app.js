import axios from 'axios';
import './bootstrap';


const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
}