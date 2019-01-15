<template>
    <v-container fluid grid-list-md>
        <!--Employee list-->
        <v-layout row wrap>
            <v-flex xs12>
                <v-card>
                    <v-data-table
                            :headers="headers"
                            :items="employees"
                            :loading="loading"
                            :pagination.sync="pagination"
                            :total-items="pagination.totalItems"
                            :rows-per-page-items="pagination.rowsPerPageItems"
                            class="elevation-1"
                    >
                        <template slot="items" slot-scope="props">
                            <td>{{ props.item.name }}</td>
                            <td class="text-xs-right">{{ props.item.email }}</td>
                            <td class="text-xs-right">{{ props.item.department }}</td>
                            <td class="text-xs-right">
                                <span v-for="position in props.item.staffPositions">{{ position.name }} </span>
                            </td>
                            <td class="text-xs-right">{{ props.item.totalSalary }}</td>
                        </template>
                    </v-data-table>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        data () {
            return {
                headers: [
                    {
                        text: 'Name',
                        align: 'left',
                        value: 'first_name'
                    },
                    { text: 'Email', value: 'email' },
                    { text: 'Department', value: 'dep' },
                    { text: 'Staff Positions', value: 'staffPosition', sortable:false },
                    { text: 'Total Salary', value: 'totalSalary', sortable:false },
                ],
                employees: [],
                pagination: {
                    descending: false,
                    sortBy: '',
                    page: 1,
                    lastPage: 1,
                    rowsPerPage: 10,
                    rowsPerPageItems: [5,10,20],
                    totalItems: 0,
                },
                loading: false,
            }
        },
        created(){
            this.getEmployees()
        },
        watch: {
            'pagination.page': {
                handler () {
                    this.getEmployees()
                },
                deep: true
            },
        },
        methods: {
            getEmployees(){
                this.loading = true
                let config = {
                    params: {
                        page: this.pagination.page,
                        rowsPerPage: this.pagination.rowsPerPage,
                        sortBy: this.pagination.sortBy,
                        descending: this.pagination.descending,
                    },
                }
                axios.get('/api/employees/', config)
                    .then(res => res.data)
                    .then(res => {
                        this.employees = res.data
                        this.pagination.totalItems = res.meta.total
                    })
                    .finally(() => this.loading = false)
                    .catch(err => console.warn(err))
            }
        }
    }
</script>