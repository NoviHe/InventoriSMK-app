import Vue from 'vue'
import axios from 'axios'

new Vue({
    el: '#dw',
    data: {
        inventaris: {
            id_inventaris: '',
            jumlah: '',
            nama: '',
        }
    },
    watch: {
        'inventaris.id_inventaris': function () {
            if (this.inventaris.id_inventaris) {
                this.getBarang()
            }
        }
    },
    mounted() {
        $('#id_inventaris').select2({
            width: '100%'
        }).on('change', () => {
            this.inventaris.id_inventaris = $('#id_inventaris').val();
        });
    },
    methods: {
        getBarang() {
            axios.get(`/api/inventaris/${this.inventaris.id_inventaris}`)
                .then((response) => {
                    this.inventaris = response.data
                })
        }
    }
})
