<template>
    <div class="container">

        <h1>YCode test - Jorge Parra</h1>

        <table class="table">
            <tr>
                <th>
                    <input type="text" class="form-control" ref="name" placeholder="Name" v-model="nameText">
                </th>
                <th></th>
                <th>
                    <input type="date" class="form-control" ref="date" placeholder="Date" v-model="dateText">
                </th>
            </tr>
            <tr>
                <th>Name</th>
                <th>URL</th>
                <th>Date created</th>
            </tr>
            <tr v-for="web in filteredList" :key="web.id">
                <td>{{ web.name }}</td>
                <td>{{ web.url }}</td>
                <td>{{ web.created_at }}</td>
            </tr>
        </table>

        <button @click="$router.push('/create')" class="btn btn-primary">Add website now!</button>

    </div>

</template>

<script>
    export default {
        data() {
            return {
                websites: [],
                nameText: '',
                dateText: '',
            }
        },
        computed: {
            filteredList() {
                if ( (this.nameText != '' && this.dateText == '') || (this.nameText == '' && this.dateText == '')) {
                    return this.websites.filter( item => item.name.toLowerCase().indexOf(this.nameText.toLowerCase()) >= 0);
                } else if (this.nameText == '' && this.dateText != '') {
                    return this.websites.filter( item => item.created_at.toLowerCase().indexOf(this.dateText.toLowerCase()) >= 0);
                } else {
                    return this.websites.filter( item =>  item.name.toLowerCase().indexOf(this.nameText.toLowerCase()) >= 0 && item.created_at.toLowerCase().indexOf(this.dateText.toLowerCase()) >= 0);
                }
                    
            }
        },
        methods: {
            async getSites() {
                try {
                    const res = await fetch('http://localhost/ycodewebsites/public/api/websites');
                    this.websites = await res.json();
                } 
                catch(error) {
                    console.log(error);
                }
            },
        },
        beforeMount() {
            this.getSites();
        },

    }
</script>
