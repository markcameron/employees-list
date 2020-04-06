pipeline {
    agent none
    stages {

        stage('Build frontend') {
            agent { docker 'node:10' }
            steps {
                sh 'node --version'
                dir("employee-management") {
                    sh 'ls -la'
                    sh 'npm install'
                    sh 'node_modules/.bin/ng build --prod'
                }
            }
        }

        stage('Build backend') {
            agent { docker 'composer:latest' }
            steps {
                dir("laravel1") {
                    sh 'ls -la'
                    sh 'composer install'
                }
            }
        }

        stage('Dockerize frontend') {
            agent { docker 'composer:latest' }
            steps {
                dockerfile {
                    filename 'Dockerfile'
                    dir 'employee-management'
                    label "flicc-product-viewer-frontend:${env.BUILD_ID}"
                }
            }
        }
    }
}
