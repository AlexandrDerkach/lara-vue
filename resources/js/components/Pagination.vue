<template>
    <ul class="pagination justify-content-center">
        <li v-if="pagination.current_page > 1">
            <a href="javascript:void(0)" aria-label="Previous" v-on:click.prevent="changePage(pagination.current_page - 1)">
                <span aria-hidden="true">«</span>
            </a>
        </li>
        <li v-for="page in pagesNumber" :class="{'active': page == pagination.current_page}">
            <a href="javascript:void(0)" v-on:click.prevent="changePage(page)">{{ page }}</a>
        </li>
        <li v-if="pagination.current_page < pagination.last_page">
            <a href="javascript:void(0)" aria-label="Next" v-on:click.prevent="changePage(pagination.current_page + 1)">
                <span aria-hidden="true">»</span>
            </a>
        </li>
    </ul>
</template>
<script>
    export default {
        props: {
            pagination:{
                type: Object,
                required: true
            },
            offset: {
                type: Number,
                default: 4
            }
        },
        computed: {
            pagesNumber() {
                let app = this
                if (!app.pagination.to) {
                    return [];
                }
                let from = app.pagination.current_page - app.offset;
                if (from < 1) {
                    from = 1;
                }
                let to = from + (app.offset * 2);
                if (to >= app.pagination.last_page) {
                    to = app.pagination.last_page;
                }
                let pagesArray = [];
                for (let page = from; page <= to; page++) {
                    pagesArray.push(page);
                }
                return pagesArray;
            }
        },
        methods : {
            changePage(page) {
                let app = this
                app.pagination.current_page = page;
                app.$emit('paginate');
            }
        }
    };
</script>
