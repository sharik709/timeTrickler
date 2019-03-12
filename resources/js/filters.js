import Vue from 'vue';
import moment from 'moment'


Vue.filter('formatDate', (value, format = 'lll') => {
    if( !value ) return;
    return moment(value).format(format)
})