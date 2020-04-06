node {

    stage('Clone repository') {
        checkout scm
    }

    stage("Prepare frontend") {
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
                  node_modules/.bin/ng build --prod
                '''
            }
        }
    }

    stage('Dockerize frontent') {
        /* This builds the actual image; synonymous to
         * docker build on the command line */
        script: '''
           ls -la employee-management
           ls -la employee-management/dist
        '''
        def customImage = docker.build("flicc-product-viewer:${env.BUILD_ID}", "employee-management")
    }

}
