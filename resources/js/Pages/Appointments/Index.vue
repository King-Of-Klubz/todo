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
                    <vc-calendar is-expanded/>
                </div>
            </div>
        </div>

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
import Welcome from "@/Jetstream/Welcome";

export default {
    components: {
        Welcome,
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
