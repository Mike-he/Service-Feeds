// Declarative //
pipeline {
    agent {
            label 'slave-php'
        }
    stages {
        stage('Build') {
            steps {
                echo 'Build Docker Image...'
                sh 'sudo docker build -t registry-internal.cn-shanghai.aliyuncs.com/sandbox3/service-feed:$BRANCH_NAME .'
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
                    sh 'sudo docker login -u account@sandbox3.cn -p Sandhill2290 registry-internal.cn-shanghai.aliyuncs.com'
                    sh 'sudo docker push registry-internal.cn-shanghai.aliyuncs.com/sandbox3/service-feed'
                }
            }
        stage('Notice') {
            steps {
                echo 'Notice..'
            }
        }
    }
}

