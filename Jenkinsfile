node {

    stage('Clone repository') {
        checkout scm
    }

    stage("Prepare frontend") {
        docker.image('node:10').pull()
        docker.image('ismail0352/chrome-node').pull()

        parallel {
            docker.image('node:10').inside {
                stage('Build angular app') {
                    sh label:
                    'Running npm install',
                        script: '''
                  node --version
                  cd employee-management
                  npm install
                  node_modules/.bin/ng build --prod
                '''
                }
            }

            docker.image('composer:latest').inside {
                stage('Build Laravel PHP backend') {
                    sh label:
                    'Running composer install',
                        script: '''
                  composer --version
                  cd laravel1
                  composer install
                '''
                }
            }
        }
    }

    stage('Dockerize frontend') {
        /* This builds the actual image; synonymous to
         * docker build on the command line */
        sh label:
          'Check directories',
        script: '''
           ls -la employee-management
           ls -la employee-management/dist
        '''
        def customImage = docker.build("flicc-product-viewer:${env.BUILD_ID}", "employee-management")
    }

}
