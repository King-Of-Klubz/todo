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
                    <vc-calendar is-expanded :min-date="new Date()" :attributes="attributes"/>
                </div>
            </div>
            <inertia-table
            ></inertia-table>
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
import InertiaTable from 'inertia-table';

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
        InertiaTable
    },
    props: [
        'appointments'
    ],
    data() {
        const todos = [
            {
                description: 'Take Noah to basketball practice.',
                isComplete: false,
                dates: {weekdays: 6}, // Every Friday
                color: 'red',
            },
        ];
        return {
            incId: todos.length,
            todos,
        };
    },
    computed: {
        attributes() {
            return [
                // Attributes for todos

                ...this.todos.map(todo => ({
                    dates: todo.dates,
                    bar: {
                        color: todo.color,
                        class: todo.isComplete ? 'opacity-75' : '',
                    },
                    popover: {
                        label: todo.description,
                    },
                    customData: todo,
                })),
            ];
        },
    },
}
</script>
