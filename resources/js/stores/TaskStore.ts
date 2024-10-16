import { defineStore } from 'pinia';
import { Task } from '../types/Task';

export const useTaskStore = defineStore('taskStore', {
    state: () => ({
        tasks: [] as Task[],
        taskDialog: false,
    }),
    actions: {
        addTask(newTask: Task) {
            this.tasks.unshift(newTask);
        },
        setTasks(newTasks: Task[]) {
            this.tasks = newTasks;
        },
        openTaskDialog() {
            this.taskDialog = true;
        },
        closeTaskDialog() {
            this.taskDialog = false;
        }
    },
});
