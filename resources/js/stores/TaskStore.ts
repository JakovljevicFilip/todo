import { defineStore } from 'pinia';
import { Task } from '../types/Task';

export const useTaskStore = defineStore('taskStore', {
    state: () => ({
        task: {} as Task,
        tasks: [] as Task[],
        taskDialog: false,
    }),
    actions: {
        setTask(task: Task)  {
            this.task = task;
        },
        clearTask()  {
            this.task = {};
        },
        addTask(newTask: Task) {
            this.tasks.unshift(newTask);
        },
        setTasks(newTasks: Task[]) {
            this.tasks = newTasks;
        },
        changeTask(task: Task) {
            const index = this.tasks.findIndex((oldTask: Task) => oldTask.id === task.id);
            this.tasks[index] = task;
        },
        removeTask(task: Task) {
            const index = this.tasks.findIndex(existingTask => existingTask.id === task.id);
            this.tasks.splice(index, 1);
        },
        openTaskDialog() {
            this.taskDialog = true;
        },
        closeTaskDialog() {
            this.taskDialog = false;
        }
    },
});
