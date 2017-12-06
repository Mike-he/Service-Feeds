// Declarative //
pipeline {
    agent {
            label 'slave-php'
        }
    stages {
        stage('Build') {
            steps {
                echo 'Build Docker Image...'
                sh 'echo $BRANCH_NAME'
            }
        }

        stage('Test') {
            steps {
                echo 'Testing..'
            }
        }

        stage('Deploy') {
            steps {
                echo 'Deploying..'
                }
            }
        stage('Notice') {
            steps {
                echo 'Notice..'
            }
        }
    }
}

