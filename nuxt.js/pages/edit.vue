<template>
    <section>
        <div class="container">

            <div class="row mt-5 justify-content-end">
                <div class="col">
                    <button type="button" class="close" @click="$router.push('/')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-sm-8 offset-sm-2">
                    <h3>Edit webhook</h3>

                    <p class="text-danger mt-3" v-if="Object.keys(errors).length">whoops! something wrong with you.</p>
                    <form>
                        <div class="form-group">
                            <label >Slug name (Required)</label>
                            <input type="text" class="form-control" v-model="edit.name">
                            <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                            <small class="form-text text-danger" v-if="errors.name">50文字以内の半角英数字で入力してください。</small>
                        </div>
                        <div class="form-group">
                            <label >End-Point URL (Optional)</label>
                            <input type="text" class="form-control" v-model="edit.url">
                            <small class="form-text text-danger" v-if="errors.url">URLの形式で入力してください。</small>
                        </div>
                        <!--<div class="form-check">-->
                        <!--<input type="checkbox" class="form-check-input" id="exampleCheck1">-->
                        <!--<label class="form-check-label" for="exampleCheck1">Check me out</label>-->
                        <!--</div>-->
                        <a tabindex="0" class="btn btn-success" @click="update(edit)">Edit</a>
                        <a tabindex="0" class="btn btn-danger" @click="destroy(currentName)">Delete</a>
                    </form>
                </div>
            </div>


        </div>
    </section>
</template>

<script>
    import axios from 'axios'

    export default {
        components: {
        },
        data(){
            return {
                errors: {},
                edit: Object.assign({}, this.$store.state.edit),
                currentName: this.$store.state.edit.name
            }
        },
        methods: {
            update() {
                axios.post('/api/webhook/update', {
                    name: this.edit.name,
                    url: this.edit.url,
                    currentName: this.currentName
                })
                    .then(response => {
                        location.href = '/'
                    })
            },
            destroy(name) {
                axios.delete('/api/webhook/destroy/' + name)
                location.href = '/'
            }
        }
    }
</script>

<style>

</style>
