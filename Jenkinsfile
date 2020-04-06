pipeline {
    agent none
    stages {
        stage('Build frontend') {
            agent { docker 'node:10' }
            steps {
                sh 'node --version'
                sh 'cd employee-management'
                sh 'npm install'
                sh 'node_modules/.bin/ng build --prod'
            }
        }
    }
}
