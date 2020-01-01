<template>
    <div class="container">
        <question :question="question"></question>
        <answers :question="question"></answers>
    </div>
</template>

<script>
    import Question from '../components/Question';
    import Answers from '../components/Answers';

    export default {
        name: "QuestionPage",
        components: {
            Question,
            Answers
        },
        props: ['question']
    }
</script>

<style scoped>

</style>
