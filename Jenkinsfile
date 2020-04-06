node {

    stage('Clone repository') {
        checkout scm
    }

    stage("Main build") {
        docker.image('node:10').pull()
        docker.image('ismail0352/chrome-node').pull()

        docker.image('node:10').inside {
            stage('Install') {
                sh label:
                  'Running npm install',
                script: '''
                  node --version
                  cd employee-management
                  npm install
                '''
            }

            stage('Build') {
                sh label:
                  'Running npm install',
                script: '''
                  node --version
                  cd employee-management
                  ng build --prod
                '''
            }
        }
    }

}
