<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="list-group">
                    <a v-for="(todo, index) in to_do_lists" :href="'/to-do-list/'+ todo.slug" class="list-group-item list-group-item-action list-group-item-light">{{todo.title}}</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "todo-list",
    data(){
        return {
           to_do_lists: {}
        }
    },
    mounted() {
        axios.get('/to-do-list?ajax=1')
            .then(response => {
                this.to_do_lists = response.data.todo_lists;
            })
            .catch(error => {
                console.log(error);
            });
    }
}
</script>
