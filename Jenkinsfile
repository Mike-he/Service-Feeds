// Declarative //
pipeline {
    agent {
            label 'slave-php'
        }
    stages {
        stage('Build') {
            steps {
                echo 'Build Docker Image...'
                script {
                    sh 'sudo docker build -t registry-internal.cn-shanghai.aliyuncs.com/sandbox3/service-feed: env.BRANCH_NAME .'
                }
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
        }
        stage('Notice') {
            steps {
                echo 'Notice..'
            }
        }
    }
}

