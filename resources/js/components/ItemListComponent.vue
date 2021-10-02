<template>
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-md-8">
                <h2>{{todo.title}}</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8" v-if="viewType == 'list'">
                <table class="table">
                    <tbody>
                    <tr v-for="(item, index) in items">
                        <th scope="row">
                            <input type="checkbox" @change="toggleComplete(item)" v-model="item.complete">
                        </th>
                        <td>{{item.title}} <br> {{item.description}}</td>
                        <td v-if="user_id === todo.user_id"><button class="btn btn-link" type="button" @click="addItem(item)">Edit</button></td>
                        <td v-if="user_id === todo.user_id"><button class="btn btn-link" type="button" @click="deleteItem(item)">Delete</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-8" v-if="viewType == 'form'">
                <form id="addItem" @submit.prevent="saveItem()">
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Title" :value="item.title">
                        <span class="invalid-feedback d-inline" role="alert" v-if="errors.title" v-for="(error, index) in errors.title">
                            <strong>{{error}}</strong>
                        </span>
                        <textarea class="form-control mt-2" name="description"  cols="30" rows="5" placeholder="Enter Description" v-html="item.description"></textarea>
                        <span class="invalid-feedback d-inline" role="alert" v-if="errors.description" v-for="(error, index) in errors.title">
                            <strong>{{error}}</strong>
                        </span>
                        <button class="btn btn-primary mt-4 btn-block" @click="saveItem()" type="button">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8" v-if="viewType == 'form'">
                <button class="btn btn-link float-right" type="button" @click="backButton()">return</button>
            </div>
        </div>
        <div class="row" v-if="viewType == 'list' && user_id === todo.user_id">
            <div class="col-md-8">
                <button type="button" @click="addItem()" class="btn btn-danger btn-circle btn-xl float-right">&#43;</button>
            </div>
        </div>
    </div>
</template>

<script>
import {forEach} from "lodash/fp/_util";

export default {
    name: "item-list",
    data(){
        return {
            items: {},
            viewType: 'list',
            errors: {},
            item: {},
        }
    },
    mounted() {
        this.getItems();
    },
    methods: {
        getItems() {
            axios.get('/to-do-list/'+this.todo.slug + '?ajax=1')
                .then(response => {
                    this.items = response.data.items;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        addItem(item = null) {
            if (item) {
                this.item = item;
            } else {
                this.item = {};
            }
            this.viewType = 'form';
        },
        saveItem() {
            let formData;
            let url;
            formData = new FormData(document.getElementById('addItem'));
            formData.append('todo_id', this.todo.id);
            if (this.item.title) {
                formData.append('_method', 'PUT');
                url = '/items/'+this.item.id;
            } else {
                url = '/items';
            }
            axios.post(url, formData).then(response => {
                this.viewType = 'list';
                this.errors = {};
                this.getItems();
            }).catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        deleteItem(item) {
            axios.delete('/items/'+item.id).then(response => {
                this.getItems();
            }).catch(e => {
                console.log(e);
            });
        },
        toggleComplete(item) {
            var data = {
                complete: item.complete
            }
            axios.post('/complete/'+item.id, data).then(response => {
                this.getItems();
            }).catch(e => {
                console.log(e);
            });
        },
        backButton() {
            this.errors = {};
            this.viewType = 'list';
        }
    },
    props: {
        todo: Object,
        user_id: Number
    },
}
</script>

<style lang="scss">
    .btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 10px 16px;
        border-radius: 35px;
        font-size: 12px;
        text-align: center;
    }
</style>
