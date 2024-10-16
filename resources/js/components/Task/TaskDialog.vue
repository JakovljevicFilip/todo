<template>
    <q-dialog v-model="localTaskDialog" persistent>
        <q-card style="min-width: 350px">
            <q-card-section>
                <div class="text-h6">Create New Task</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
                <q-input
                    dense
                    v-model="taskTitle"
                    label="Task Title"
                    autofocus
                    @keyup.enter="createTask"
                    :rules="[val => !!val || 'Title is required']"
                />

                <q-input
                    dense
                    v-model="taskDescription"
                    label="Description"
                    type="textarea"
                    autogrow
                />

                <q-input
                    dense
                    v-model="taskScheduled"
                    label="Scheduled Date"
                    mask="####-##-##"
                    placeholder="YYYY-MM-DD"
                />
            </q-card-section>

            <q-card-actions align="right" class="text-primary">
                <q-btn flat label="Cancel" @click="closeDialog" />
                <q-btn flat label="Create Task" @click="createTask" />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script setup lang="ts">
import { ref, defineProps, defineEmits, watch } from 'vue';
import {createTask as createTaskService} from '../../services/TaskService.js';
import { NewTask } from '../../types/NewTask';

const props = defineProps({
    taskDialog: {
        type: Boolean,
        required: true,
    },
});

const emit = defineEmits(['update:taskDialog', 'taskCreated']);
const localTaskDialog = ref(props.taskDialog);

const taskTitle = ref('');
const taskDescription = ref('');
const taskScheduled = ref('');

watch(() => props.taskDialog, (newValue) => {
    localTaskDialog.value = newValue;
});

watch(localTaskDialog, (newValue) => {
    emit('update:taskDialog', newValue);
});

const closeDialog = () => {
    localTaskDialog.value = false;
};

const createTask = () => {
    if (!taskTitle.value) return;

    const newTask = {
        title: taskTitle.value,
        description: taskDescription.value,
        scheduled: taskScheduled.value || null,
    } as NewTask;

    createTaskService(newTask)
    .then(() => {
        emit('taskCreated', newTask);
        closeDialog();
    });
};
</script>

<style scoped>
</style>
