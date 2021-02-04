<template>
    <app-layout>
        <template #header>
            <h2 class="font-semi-bold text-xl text-gray-800 leading-tight">
                Team Work Planner
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-8 bg-white border-b border-gray-200">

                        <div class="mt-8 md:flex">

                            <h1 class="text-2xl md:w-5/6">
                               Team Tasks
                            </h1>

                            <div class="md:w-1/6 text-right">
                                <button class="bg-gray-800 hover:bg-gray-600 text-xs text-white font-semi-bold py-2 px-4 rounded transition ease-in-out duration-150"
                                        @click="addTaskDialog">
                                    Create Task
                                </button>
                            </div>

                        </div>

                    </div>
                    <div class="bg-gray-200 bg-opacity-25">

                        <table class="table-auto w-full">
                            <thead class="text-left">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">List</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Done</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <template v-if="tasks.data.length">
                                <tr v-for="task in tasks.data" :key="task.id">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ task.description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap" >
                                        <span :class="'px-2 inline-flex text-md leading-7 font-semibold rounded-full '+ task.color">
                                                {{ task.title }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ task.status }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <button class="bg-blue-600 hover:bg-blue-400 text-xs text-white font-semi-bold py-2 px-4 rounded transition ease-in-out duration-150" @click="updateTaskDialog(task)">
                                            Edit
                                        </button>
                                        <button class="bg-red-600 hover:bg-red-400 text-xs text-white font-semi-bold py-2 px-4 rounded transition ease-in-out duration-150" @click="confirmTaskDeletion(task)">
                                            Delete
                                        </button>

                                    </td>
                                </tr>
                            </template>
                            <tr v-else>
                                <td colspan="2" class="border px-8 py-2">No Tasks</td>
                            </tr>

                            </tbody>
                        </table>
                        <inertia-table
                        ></inertia-table>
                    </div>
                    <div class="p-6 sm:px-8 bg-white border-b border-gray-200">

                        <div class="md:flex md:justify-end">

                            <div class="md:w-1/6 text-right">
                                <button class="bg-gray-800 hover:bg-gray-600 text-xs text-white font-semi-bold py-2 px-4 rounded transition ease-in-out duration-150"
                                        @click="addTaskDialog">
                                    Create task
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New task Modal -->
        <jet-dialog-modal :show="showNewTaskDialog" @close="showNewTaskDialog = false">
            <template #title>
                Add Task
            </template>

            <template #content>
                <!-- Title -->
                <div class="mt-4">
                    <jet-label for="description" value="Description"/>
                    <jet-input id="description" type="text" class="mt-1 block w-full" v-model="addTaskForm.description"/>
                    <jet-input-error for="description" class="mt-2"/>
                </div>
                <div class="mt-4">
                    <jet-label for="level_id" value="Priority"/>
                    <jet-select id="level_id" class="mt-1 block w-full" v-model="addTaskForm.level_id" :options="levels.data"/>
                    <jet-input-error for="level_id" class="mt-2"/>
                </div>



            </template>

            <template #footer>
                <jet-secondary-button @click.native="showNewTaskDialog = false">
                    That's All
                </jet-secondary-button>

                <jet-button class="ml-2" @click.native="addTask" :class="{ 'opacity-25': addTaskForm.processing }"
                            :disabled="addTaskForm.processing">
                    Save it
                </jet-button>

            </template>
        </jet-dialog-modal>

        <!-- Update Task Modal -->
        <jet-dialog-modal :show="showUpdateTaskDialog" @close="showUpdateTaskDialog = false">
            <template #title>
                Update Task
            </template>

            <template #content>
                <!-- Title -->
                <div class="mt-4">
                    <jet-label for="description" value="Description"/>
                    <jet-input id="description" type="text" class="mt-1 block w-full" v-model="updateTaskForm.description"/>
                    <jet-input-error for="description" class="mt-2"/>

                    <!-- <jet-input-error :message="updateTaskForm.error('description')" class="mt-2"/> -->
                </div>
                <div class="mt-4">
                    <jet-label for="level_id" value="Priority"/>
                    <jet-select id="level_id" class="mt-1 block w-full" v-model="updateTaskForm.level_id" :options="levels.data"/>
                    <jet-input-error for="level_id" class="mt-2"/>
                </div>


            </template>

            <template #footer>
                <jet-secondary-button @click.native="showUpdateTaskDialog = false">
                    Never mind
                </jet-secondary-button>

                <jet-button class="ml-2" @click.native="updateTask"
                            :class="{ 'opacity-25': showUpdateTaskDialog.processing }"
                            :disabled="showUpdateTaskDialog.processing">
                    Save
                </jet-button>

            </template>
        </jet-dialog-modal>

        <!-- Delete Task Modal -->
        <jet-confirmation-modal :show="taskToDelete" @close="taskToDelete = null">
            <template #title>
                Delete Task
            </template>

            <template #content>
                Are you sure you would like to delete this Task?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="taskToDelete = null">
                    Never mind
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="deleteTask"
                                   :class="{ 'opacity-25': deleteTaskForm.processing }"
                                   :disabled="deleteTaskForm.processing">
                    Delete
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetActionMessage from './../../Jetstream/ActionMessage'
import JetActionSection from './../../Jetstream/ActionSection'
import JetButton from './../../Jetstream/Button'
import JetConfirmationModal from './../../Jetstream/ConfirmationModal'
import JetDangerButton from './../../Jetstream/DangerButton'
import JetDialogModal from './../../Jetstream/DialogModal'
import JetFormSection from './../../Jetstream/FormSection'
import JetSelect from './../../Jetstream/Select'
import JetInput from './../../Jetstream/Input'
import JetInputError from './../../Jetstream/InputError'
import JetLabel from './../../Jetstream/Label'
import JetSecondaryButton from './../../Jetstream/SecondaryButton'
import JetSectionBorder from './../../Jetstream/SectionBorder'
import InertiaTable from 'inertia-table'

export default {
    components: {
        AppLayout,
        JetActionMessage,
        JetActionSection,
        JetButton,
        JetConfirmationModal,
        JetDangerButton,
        JetDialogModal,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        JetSectionBorder,
        JetSelect,
        InertiaTable
    },
    props: [
        'tasks','levels'
    ],
    data() {
        return {
            addTaskForm: this.$inertia.form({
                description: '',
                level_id:''
            }, {
                bag: 'addTaskForm',
                resetOnSuccess: true,
            }),

            updateTaskForm: this.$inertia.form({
                description: '',
                level_id:''
            }, {
                bag: 'updateTaskForm',
                resetOnSuccess: true,
            }),

            deleteTaskForm: this.$inertia.form(),
            taskToDelete: false,

            taskId: null,
            showNewTaskDialog: false,
            showUpdateTaskDialog: false,

        }
    },
    methods: {
        addTask() {
            this.addTaskForm.post('/tasks', {
                preserveScroll: true
            })
        },
        addTaskDialog() {
            this.showNewTaskDialog = true
        },
        updateTask() {
            this.updateTaskForm.put('/tasks/' + this.taskId, {
                preserveScroll: true
            })
        },
        updateTaskDialog(task) {
            this.updateTaskForm.id = task.id
            this.updateTaskForm.description = task.description
            this.updateTaskForm.level_id = task.level_id
            this.taskId = task.id
            this.showUpdateTaskDialog = true
        },
        confirmTaskDeletion(task) {
            this.taskToDelete = task
        },

        deleteTask() {
            this.deleteTaskForm.delete('/tasks/' + this.taskToDelete.id, {
                preserveScroll: true,
                preserveState: true,
            }).then(() => {
                this.taskToDelete = null
            })
        },

    }
}
</script>
