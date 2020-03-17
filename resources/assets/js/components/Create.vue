<template>
    <div class="container">
        <h1>Add new website</h1>
        <form class="form-inline">
            <div class="form-group">
                <label for="name" class="sr-only">Name</label>
                <input type="text" class="form-control" id="name" v-model="newData.name" placeholder="name">
            </div>
            <div class="form-group">
                <label for="url" class="sr-only">URL</label>
                <input type="text" class="form-control" id="url" v-model="newData.url" placeholder="url">
            </div>
            <button type="submit" class="btn btn-primary" @click.prevent="sendData()">Add new site</button>
        </form>

    </div>

</template>

<script>
    export default {
        data() {
            return {
                newData: {
                    name:'',
                    url: ''
                }
            }
        },
        methods: {
            async sendData() {
                if ( this.newData.name != '' && this.newData.url != '' ) {
                    try {
                        const res = await fetch('http://localhost/ycodewebsites/public/api/websites', {
                            method: 'POST',
                            mode: 'cors',
                            cache: 'no-cache',
                            credentials: 'same-origin',
                            headers: {
                            'Content-Type': 'application/json',
                            'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(this.newData)
                        });
                        this.newData = { name: '', url: '' };
                        this.$router.push('/');
                    } 
                    catch(error) {
                        console.log(error);
                    }               
                } else {
                    alert('Please, fill in the data before pressing the add button');
                }
            }
        },

    }
</script>

<style scoped>
    .form-control {
        margin-right: 20px;
    }
</style>
