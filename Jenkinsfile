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
                sh 'php app/console cache:clear --env=dev'
                sh 'chmod -R 777 app/cache/ app/logs/'
                sh 'php app/console doc:mig:mig -q'
            }
        }

        stage('Deploy') {
            steps {
                sh 'sudo docker build -t registry-internal.cn-shanghai.aliyuncs.com/sandbox3/service-feed:$BRANCH_NAME .'
                sh 'sudo docker login -u account@sandbox3.cn -p Sandhill2290 registry-internal.cn-shanghai.aliyuncs.com'
                sh 'sudo docker push registry-internal.cn-shanghai.aliyuncs.com/sandbox3/service-feed'

                script {
                    if (env.BRANCH_NAME == 'develop') {
                        sh "curl 'https://cs.console.aliyun.com/hook/trigger?triggerUrl=Y2RlY2RkMTJlYTZhOTRmNTQ5MDQ3MWFjODJiMjI5MjNifGFwaS1zZXJ2aWNlLWZlZWR8cmVkZXBsb3l8MWEwaHMxcmhxYmVzMHw=&secret=4e6f3671564e634f494c496c77753770ba16fd9bed744d89a34df654d2db6742'"
                    } else if (env.BRANCH_NAME == 'staging') {
                        sh "curl 'https://cs.console.aliyun.com/hook/trigger?triggerUrl=Y2YxOTJlM2JlYzM0YjRmMjI4ZDVlNzI2MGVmM2MwMjExfGFwaS1zZXJ2aWNlLWZlZWR8cmVkZXBsb3l8MWEwaHN0dGhyazhqMHw=&secret=4d7a55436c5a49566e6c4574503247748b079edf035c779468f59dcd773c8595'"
                    } else if (env.BRANCH_NAME == 'master') {

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

