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
                <th @click="sort('name')">Name <span>▼▲</span></th>
                <th @click="sort('url')">URL <span>▼▲</span></th>
                <th @click="sort('created_at')">Date created <span>▼▲</span></th>
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
                nameOrder: false,
                urlOrder: false,
                dateOrder: false,
                sorted: false,
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

            sort(type) {
                
                if (type == 'name') {
                    if (this.nameOrder == false) {
                        this.nameOrder = true;
                        this.websites.sort(this.compareNamesR);
                    } else {
                        this.nameOrder = false;
                        this.websites.sort(this.compareNames); 
                    }
                }else if ( type == 'url') {
                    if (this.urlOrder == false) {
                        this.urlOrder = true;
                        this.websites.sort(this.compareWebs);
                    } else {
                        this.urlOrder = false;
                        this.websites.sort(this.compareWebsR);
                    }
                }else if ( type == 'created_at' ) {
                    if (this.dateOrder == false) {
                        this.dateOrder = true;
                        this.websites.sort(this.compareDates);
                    } else {
                        this.dateOrder = false;
                        this.websites.sort(this.compareDatesR);
                    }
                }
            },

            compareNames(a, b) {
                const webA = a.name.toUpperCase();
                const webB = b.name.toUpperCase();

                let comparison = 0;
                if (webA > webB) {
                    comparison = 1;
                } else if (webA < webB) {
                    comparison = -1;
                }
                return comparison;
            },
            compareWebs(a, b) {
                const webA = a.url.toUpperCase();
                const webB = b.url.toUpperCase();

                let comparison = 0;
                if (webA > webB) {
                    comparison = 1;
                } else if (webA < webB) {
                    comparison = -1;
                }
                return comparison;
            },
            compareDates(a, b) {
                const webA = a.created_at.toUpperCase();
                const webB = b.created_at.toUpperCase();

                let comparison = 0;
                if (webA > webB) {
                    comparison = 1;
                } else if (webA < webB) {
                    comparison = -1;
                }
                return comparison;
            },

            compareNamesR(a, b) {
                const webA = a.name.toUpperCase();
                const webB = b.name.toUpperCase();

                let comparison = 0;
                if (webA > webB) {
                    comparison = 1;
                } else if (webA < webB) {
                    comparison = -1;
                }
                return comparison * -1;
            },
            compareWebsR(a, b) {
                const webA = a.url.toUpperCase();
                const webB = b.url.toUpperCase();

                let comparison = 0;
                if (webA > webB) {
                    comparison = 1;
                } else if (webA < webB) {
                    comparison = -1;
                }
                return comparison * -1;
            },
            compareDatesR(a, b) {
                const webA = a.created_at.toUpperCase();
                const webB = b.created_at.toUpperCase();

                let comparison = 0;
                if (webA > webB) {
                    comparison = 1;
                } else if (webA < webB) {
                    comparison = -1;
                }
                return comparison * -1;
            }
        },
        beforeMount() {
            this.getSites();
        },

    }
</script>

<style scoped>
    th {
        cursor: pointer;
    }
</style>
