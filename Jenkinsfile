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
    }
}
