node {

    stage('Clone repository') {
        checkout scm
    }

    stage("Build frontend") {
        docker.image('node:10').pull()

        docker.image('node:10').inside {
            stage('Build angular app') {
                sh label:
                  'Build angular app',
                script: '''
                  node --version
                  cd employee-management
                  npm install
                  node_modules/.bin/ng build --prod
                '''
            }
        }
    }

    stage("Build backend") {
        docker.image('composer:latest').pull()

        docker.image('composer:latest').inside {
            stage('Install PHP packages s') {
                sh label:
                  'Install PHP packages',
                script: '''
                  composer --version
                  cd laravel1
                  composer install
                '''
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

    stage('Dockerize backend') {
        sh label:
          'Check directories',
        script: '''
          ls -la laravel1
        '''
        def image = docker.build("flicc-product-viewer-backend:${env.BUILD_ID}", "-f laravel1/.docker/Dockerfile laravel1")
    }

}
