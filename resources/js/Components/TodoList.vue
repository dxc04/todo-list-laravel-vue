<template>
    <div class="h-full flex justify-center font-sans">
        <div class="bg-white rounded shadow p-3 m-4 w-full lg:w-1/2">
            <div class="mb-4">
                <h1 class="text-grey-darkest">Todo List</h1>
                <div class="flex mt-4">
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                           placeholder="Add Todo" v-model="todo.title">

                    <fieldset class="px-2 lg:w-1/3">
                        <div class="relative border border-gray-300 text-gray-800 bg-white shadow-sm">
                            <select title="Priority" v-model="todo.priority" class="appearance-none w-full py-2 px-2 mr-4 bg-white" name="whatever" id="frm-whatever">
                                <option value="MINOR">Minor</option>
                                <option value="IMPORTANT">Important</option>
                                <option value="URGENT">Urgent</option>
                            </select>
                            <div class="pointer-events-none absolute right-0 top-0 bottom-0 flex items-center px-2 text-gray-700 border-l">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </fieldset>


                    <button :disabled="!todo.title"
                        class="flex-no-shrink p-2 border-2 rounded text-teal border-teal-200 hover:text-white hover:bg-teal-300"
                        @click="addTodo">Add
                    </button>
                </div>
            </div>
            <div>
                <div v-for="todo in $page.todos" :key="todo.id" class="flex mb-4 items-center">
                    <p :class="{'w-full text-grey-darkest': true, 'line-through': todo.status == 'DONE'}">{{ todo.title }}</p>
                    <span :class="{'inline-block mr-1 last:mr-0 py-1 px-2 rounded text-xs font-semibold': true,
                        'bg-yellow-200 text-yellow-600 uppercase': todo.priority == 'MINOR',
                        'bg-blue-200 text-blue-600 uppercase': todo.priority == 'IMPORTANT',
                        'bg-pink-200 text-pink-600 uppercase': todo.priority == 'URGENT',
                        }" :title="priorityDescriptions[todo.priority]">
                      {{ todo.priority }}
                    </span>
                    <button @click="done(todo.id)" v-if="todo.status != 'DONE'"
                        class="flex-no-shrink p-2 ml-2 mr-2 border-2 rounded hover:text-white text-green border-green-200 hover:bg-green-300">
                        Done
                    </button>
                    <button @click="undo(todo.id)" v-else
                        class="flex-no-shrink p-2 ml-2 mr-2 border-2 rounded hover:text-white text-grey border-blue-200 hover:bg-blue-300">
                        Undo
                    </button>
                    <button @click="onDeleteTodo(todo)"
                        class="flex-no-shrink p-2 border-2 rounded text-red border-red-200 hover:text-white hover:bg-red-300">
                        Remove
                    </button>
                </div>
<!--                <div class="flex m-1.5"><span class="mr-1 last:mr-0 py-0 px-2 rounded bg-yellow-200 text-yellow-600 text-xs">Minor</span><p class="text-grey-dark text-xs italic">Can be done in 5 or more days.</p></div>
                <div class="flex m-1.5"><span class="mr-1 last:mr-0 py-0 px-2 rounded bg-blue-200 text-blue-600 text-xs">Important</span><p class="text-grey-dark text-xs italic">Should be done in 2-3 days.</p></div>
                <div class="flex m-1.5"><span class="mr-1 last:mr-0 py-0 px-2 rounded bg-pink-200 text-pink-600 text-xs">Minor</span><p class="text-grey-dark text-xs italic">Must be done in 1 day.</p></div>-->

            </div>
        </div>
        <jet-confirmation-modal :show="confirmingDeletion" @close="confirmingDeletion = false">
            <template #title>
                Delete Todo
            </template>

            <template #content>
                Are you sure you want to delete it?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="confirmingDeletion = false">
                    Nevermind
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="deleteTodo(todo.id)" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Delete Todo
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
    </div>
</template>

<script>
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import JetDangerButton from '@/Jetstream/DangerButton';


export default {
    name: "TodoList",
    components: {JetConfirmationModal, JetSecondaryButton, JetDangerButton},
    data() {
        return {
            todo: {
                title: null,
                priority: 'MINOR'
            },
            priorityDescriptions: {
                MINOR: 'Can be done in 5 or more days.',
                IMPORTANT: 'Should be done in 2-3 days',
                URGENT: 'Must be done in 1 day.'
            },
            confirmingDeletion: false,
            form: this.$inertia.form()
        };
    },
    methods: {
        resetTodo() {
            this.todo.title = null;
            this.todo.priority = 'MINOR';
        },
        addTodo() {
            const todo = {
                title: this.todo.title,
                priority: this.todo.priority
            };
            this.$inertia.post('todos', todo)
            this.resetTodo();
        },
        onDeleteTodo(todo) {
            this.confirmingDeletion = true;
            this.todo = todo;
        },
        deleteTodo(id) {
            this.resetTodo();
            this.$inertia.delete('todos/' + id)
        },
        done(id) {
            this.$inertia.put('todos/' + id, { status: 'DONE'});
        },
        undo(id) {
            this.$inertia.put('todos/' + id, { status: 'UNDONE'});
        }
    }
};
</script>


