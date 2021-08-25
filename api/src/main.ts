import { NestFactory } from '@nestjs/core';
import { AppModule } from './app.module';

async function bootstrap() {
  const app = await NestFactory.create(AppModule);
  app.enableCors();
  // app.enableCors({ origin: 'http://localhost:3000' });
  await app.listen(3001);
  console.log('listening 3001');
}
bootstrap();
