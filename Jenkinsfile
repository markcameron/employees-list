pipeline {
    agent any

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
            steps {
                script {
                    def customImage = docker.build("flicc-product-viewer-backend:${env.BUILD_ID}", "-f laravel1/.docker/Dockerfile laravel1")
                    // customImage.push()
                }
            }
        }
    }
}
