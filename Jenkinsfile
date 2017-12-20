// Declarative //
pipeline {
    agent {
            label 'slave-php'
        }
    stages {
        stage('Build') {
            steps {
                sh 'cp app/config/parameters_$BRANCH_NAME.yml.dist app/config/parameters.yml'
            }
        }

        stage('Test') {
            steps {
                sh 'php app/console cache:clear --env=prod'
            }
        }

        stage('Deploy') {
            steps {
                sh 'sudo docker build -t registry-internal.cn-shanghai.aliyuncs.com/sandbox3/service-feed:$BRANCH_NAME .'
                sh 'sudo docker login -u account@sandbox3.cn -p Sandhill2290 registry-internal.cn-shanghai.aliyuncs.com'
                sh 'sudo docker push registry-internal.cn-shanghai.aliyuncs.com/sandbox3/service-feed'

                script {
                    if (env.BRANCH_NAME == 'develop') {
                        sh "curl 'https://cs.console.aliyun.com/hook/trigger?triggerUrl=Y2RlY2RkMTJlYTZhOTRmNTQ5MDQ3MWFjODJiMjI5MjNifHNlcnZpY2UtZmVlZHxyZWRlcGxveXwxYTBjczZsMHZhNGVzfA==&secret=755a5349754445746431726133423448fed02c7aab147471d1c3ceaf08abec0f'"
                    } else if (env.BRANCH_NAME == 'staging') {
                        sh "curl ''"
                    } else if (env.BRANCH_NAME == 'master') {
                        sh "curl ''"
                    } else {
                        echo 'I execute elsewhere'
                    }
                }
            }
        }
    }

    post {
        success {
            script {
                echo 'success'
            }
        }

        failure {
            script {
                sh "curl 'https://oapi.dingtalk.com/robot/send?access_token=2cf510246ce6156bee19cfd9071c3af9d346596f21910eb0fc6c3bda2af7bb81' \
                    -H 'Content-Type: application/json' \
                    -d ' { \"msgtype\": \"text\",\"text\": {\"content\": \"Service-Feed 构建失败\"} }' "
            }
        }
    }
}

