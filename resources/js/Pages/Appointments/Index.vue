<template>
    <app-layout>
        <template #header>
            <h2 class="font-semi-bold text-xl text-gray-800 leading-tight">
                Team Appointments
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
                                <button class="bg-gray-800 hover:bg-gray-7000 text-xs text-white font-semi-bold py-2 px-4 rounded transition ease-in-out duration-150"
                                        @click="addTaskDialog">
                                    Create Task
                                </button>
                            </div>

                        </div>

                    </div>
                    <div class="bg-gray-200 bg-opacity-25">

                    </div>
                    <div class="p-6 sm:px-8 bg-white border-b border-gray-200">

                        <div class="md:flex md:justify-end">

                            <div class="md:w-1/6 text-right">
                                <button class="bg-gray-800 hover:bg-gray-7000 text-xs text-white font-semi-bold py-2 px-4 rounded transition ease-in-out duration-150"
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
                </div>

                <!-- Person
                 <div class="col-span-6 sm:col-span-4">
                    <jet-label for="user_id" value="Person"/>
                    <jet-select id="user_id" type="select" class="mt-1 block w-full" v-model="addTaskForm.id" :options="Users"/>
                </div>
                -->


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

                    <!-- <jet-input-error :message="updateTaskForm.error('description')" class="mt-2"/> -->
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
        JetSelect
    },
    props: [
        'appointments'
    ],
    data() {
        return {
            addTaskForm: this.$inertia.form({
                description: '',
                user_id:''
            }, {
                bag: 'addTaskForm',
                resetOnSuccess: true,
            }),

            updateTaskForm: this.$inertia.form({
                description: '',
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
            }).then(() => {
                if (!this.addTaskForm.hasErrors()) {
                    this.showNewTaskDialog = false;
                }
            })
        },
        addTaskDialog() {
            this.showNewTaskDialog = true
        },
        updateTask() {
            this.updateTaskForm.put('/tasks/' + this.taskId, {
                preserveScroll: true
            }).then(() => {
                this.taskId = null;
                if (!this.updateTaskForm.hasErrors()) {
                    this.showUpdateTaskDialog = false
                }
            })
        },
        updateTaskDialog(task) {
            this.updateTaskForm.id = task.id
            this.updateTaskForm.description = task.description
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
